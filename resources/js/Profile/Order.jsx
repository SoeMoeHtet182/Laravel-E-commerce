import axios from 'axios';
import React, { useEffect, useState } from 'react';
import Spinner from '../Component/Spinner';

const Order = () => {
  const user_id = window.auth.id;
  const [order, setOrder] = useState({});
  const [loader, setLoader] = useState(true);
  const [page, setPage] = useState(1);
  const [displayOff, setDisplayOff] = useState(false);

  useEffect(() => {
    axios.get(`/api/order?page=${page}&user_id=${user_id}`).then(res => {
      setOrder(res.data.data);
      setLoader(false);
      if (res.data.data.data.length === 0) setDisplayOff(true);
    })
  },[page])

  return (
    <>

      <div className='container py-5'>
        {loader && <Spinner />}
        {!loader && (
          <>
            {displayOff && (<div className='alert alert-secondary text-center fs-5'>You have no product in order list</div>)}
            {!displayOff && (
              <>
                  <table className='table table-striped bg-white text-center' id='order-table'>
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th width={'15%'}>Name</th>
                        <th>Image</th>
                        <th>Total Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      {order.data.map(d => (
                        <tr key={d.id}>
                          <td>{order.data.indexOf(d) + 1}</td>
                          <td className='text-wrap'>{ d.product.name}</td>
                          <td><img src={d.product.image_url} width={180} className='img-thumbnail' /></td>
                          <td>{ d.total_quantity}</td>
                          <td>{d.total_amount} $</td>
                              <td>
                                  {d.status == 'pending' && (<span className='badge bg-warning'>Pending</span>)}
                                  {d.status == 'success' && (<span className='badge bg-success'>Success</span>)}
                                  {d.status == 'cancel' && (<span className='badge bg-danger'>Cancel</span>)}
                                </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                  <div className='p-2 text-center'>
                    <button className='btn btn-sm btn-dark me-2'
                      disabled={order.prev_page_url === null ? true : false}
                      onClick={() => {setPage(page - 1)}}
                    ><i className='fa fa-arrow-left'></i></button>
                    <button className='btn btn-sm btn-dark'
                      disabled={order.next_page_url === null ? true : false}
                      onClick={() => {setPage(page + 1)}}
                    ><i className='fa fa-arrow-right'></i></button>
                  </div>
              </>
            )}
          </>
        )}
      </div>
    </>
  )
}

export default Order
