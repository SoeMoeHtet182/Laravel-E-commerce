import axios from 'axios';
import React, { useState } from 'react';

const ViewAndLike = (props) => {
    const [like, setLike] = useState(props.like);

    const likeProduct = () => {
        axios.post('/api/like-product?product_slug=' + window.product_slug + '&user_id=' + window.auth.id).then(res => {
            setLike(res.data.data);
            $('.fa-heart').css('color', res.data.css);
        })
    }
  return (
    <>
        <div className='d-inline me-2'><i className="fa-solid fa-eye"></i> { props.view }</div>
        <div className='d-inline'>
              <i className="fa-regular fa-heart me-2" style={{ 'color': props.css }}
                  onClick={() => { window.auth && likeProduct() }}></i>
               {like}
        </div>
    </>
  )
}

export default ViewAndLike
