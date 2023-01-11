import axios from 'axios';
import React, { useEffect, useState } from 'react';

const ViewAndLike = (props) => {
    const [like, setLike] = useState(props.like);

    const likeProduct = () => {
        axios.post('/api/like-product?product_slug=' + window.product_slug + '&user_id=' + window.auth.id).then(res => {
            setLike(res.data.data);
            const product = document.getElementsByClassName(window.product_slug + ' fa-heart')[0];
            product.style.color = res.data.css;
        })
    }

    useEffect(() => {
        window.auth ?
        axios.post('/api/like?product_slug=' + props.product + '&user_id=' + window.auth.id).then(res => {
            const product = document.getElementsByClassName(props.product + ' fa-heart')[0];
            product.style.color = res.data.css;
        })
            : ''
    }, []);
  return (
    <div className='text-black'>
        <div className='d-inline me-2'><i className="fa-solid fa-eye"></i> { props.view }</div>
        <div className='d-inline'>
              <i className={ props.product ? props.product + " fa-regular fa-heart me-2": "fa-regular fa-heart me-2"}
                  onClick={() => { window.auth && likeProduct() }}></i>
               {like}
        </div>
    </div>
  )
}

export default ViewAndLike
