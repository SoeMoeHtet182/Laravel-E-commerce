import axios from 'axios';
import React, { useEffect, useState } from 'react';
import Spinner from '../Component/Spinner';

const Cart = () => {
  const user_id = window.auth.id;
  const [loader, setLoader] = useState(true);
  const [cart, setCart] = useState([]);
  const [displayOff, setDisplayOff] = useState(false);
  const width = screen.width;

  // render page api
  useEffect(() => {
    axios.get('/api/cart/' + user_id).then(({ data }) => {
      setCart(data.data);
      setLoader(false);
      if (data.data.length === 0) setDisplayOff(true);
    })
  }, []);

  //add or reduce qty
  const updateQty = (id,type) => {
    const updatedQty = cart.map(d => {
        if (id == d.id) {
            if (d.product.discount_price) {
              var price = d.product.sale_price - d.product.discount_price
            } else {
                var price = d.product.sale_price
            }
        switch (type) {
          case 'add':
            d.total_quantity += 1;
            d.total_price = d.total_quantity * price;
            break;
          default:
            d.total_quantity === 1? d.total_quantity = 1:
              d.total_quantity -= 1;
              d.total_price = d.total_quantity * price;
            break;
        }
      }
      return d;
    })
    setCart(updatedQty);
  }

  //store cart to db by save btn
  const updateCartBySave = (id,qty,total_price) => {
    axios.post('/api/update-qty', { cart_id: id, cart_qty: qty,cart_total_price: total_price })
      .then(res => {
        if (res.data.message) {
          showToastSuccess('Updated quantity successfully');
        }
      });
  }

  //remove cart from db & ui api
  const removeCart = (id) => {
    axios.post('/api/remove-cart', {cart_id: id, user_id: user_id})
      .then(res => {
        if (res.data.message) {
          showToastSuccess('Remove product from cart successfully.');
          updateCart(res.data.data);
          setCart(preCart=> preCart.filter(d=>(d.id!== id)));
        }
      })
  }

  //make render total price
  const TotalPrice = () => {
    let total_price = 0;
    cart.map(d => {
      total_price += d.total_price;
    });
    return <b>{total_price} $</b>;
  }

  //store cart to order db
  const updateOrder = () => {
    axios.post('/api/update-order?user_id=' + user_id).then(d => {
      if (d.data.message === true) {
        setCart([]);
        updateCart(0);
        showToastSuccess('Order success. Please wait for admin comfirm. You can check in order');
      }
    })
  }

  return (
    <div className='container py-5'>
      <div className='row'>
        <div className='col-md-12'>
          {loader && <Spinner />}
          {!loader && (
            <>
              {displayOff && (<div className='alert alert-secondary text-center fs-5'>
                {window.locale === 'mm' ? 'သင်၏ ဈေးခြင်းထဲတွင် ဘာမှ မရှိပါ' : 'You have no product in cart'}</div>)}
              {!displayOff && (
                <>
                  <table className='table table-striped bg-white text-center align-middle' id='cart-table'>
                    <thead className='py-3'>
                      <tr>
                      <th>{window.locale === 'mm' ? 'အမှတ်စဥ်' :'No.'}</th>
                        <th width={'15%'}>{window.locale === 'mm' ? 'အမည်':'Name'}</th>
                        <th>{window.locale === 'mm' ? 'ဓာတ်ပုံ' : 'Image'}</th>
                        <th>{window.locale === 'mm' ? 'ပမာဏ' : 'Total Quantity'}</th>
                        <th>{window.locale === 'mm' ? 'ရောင်းဈေး': 'Sale Price'}</th>
                        <th>{window.locale === 'mm' ? 'စုစုပေါင်းငွေ': 'Total Price'}</th>
                        <th>{window.locale === 'mm' ? 'တိုးမည်/လျှော့မည်' : 'Add/Remove'}</th>
                        <th>{window.locale === 'mm' ? 'ဖျက်မည်': 'Delete'}</th>
                      </tr>
                    </thead>
                    <tbody>
                      {cart.map(d => (
                        <tr key={d.id}>
                          <td>{cart.indexOf(d) + 1}</td>
                          <td>{d.product.name}</td>
                          <td className='swapCol1'>
                                <img src={d.product.image_url} alt={d.product.name} width='60px' />
                            </td>
                          <td className='swapCol1'>{d.total_quantity}</td>
                          <td className='swapCol1'>{d.product.sale_price}</td>
                          <td className='swapCol'>{d.total_price}</td>
                          <td className='swapCol2'>
                            <button className='btn btn-dark btn-sm'
                              onClick={() => { updateQty(d.id, 'reduce') }}
                            >-</button>
                            <input type='text' className='btn border-danger m-1' value={d.total_quantity}
                              style={{ width: '150px' }} disabled={true} />
                            <button className='btn btn-dark btn-sm'
                              onClick={() => { updateQty(d.id, 'add') }}
                            >+</button>
                            <button className='btn btn-secondary btn-sm ms-2'
                              onClick={() => {updateCartBySave(d.id,d.total_quantity,d.total_price)}}>
                                {window.locale === 'mm' ? 'သိမ်းမည်' : 'Save'}</button>
                          </td>
                          <td className='swapCol2'>
                            <button className='btn btn-danger btn-sm' onClick={()=>{removeCart(d.id)}}>
                              <i className='fa fa-trash'></i>
                            </button>
                          </td>
                      </tr>
                      ))}
                    </tbody>
                    <tfoot className='p-2'>
                      <tr >
                        <td colSpan={6}><b className='float-end'>{window.locale === 'mm' ? 'စုစုပေါင်းကျငွေ' : 'Total'}:</b></td>
                          <td colSpan={2}><TotalPrice /></td>
                      </tr>
                    </tfoot>
                  </table>
                </>
              )}

            </>
          )}
        </div>
      </div>
      {!displayOff && (
        <div className='float-end'>
          <button className='btn btn-dark' onClick={()=>{updateOrder()}}>{window.locale === 'mm' ? 'အော်ဒါတင်မည်' : 'Order'}</button>
        </div>
      )}
    </div>
  )
}

export default Cart
