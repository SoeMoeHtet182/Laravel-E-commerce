import axios from 'axios';
import React, { useState } from 'react';
import StarRatings from 'react-star-ratings';
import Spinner from '../../Component/Spinner';

export default function Review({review}) {
    const [reviewList, setReviewList] = useState(review);
    const [comment, setComment] = useState('');
    const [rating, setRating] = useState(0);
    const [loader, setLoader] = useState(false);
    const disabledReview = rating && comment !== '' ? false : true;

    const makeReview = () => {
        setLoader(true);
        const user_id = window.auth.id;
        const slug = window.product_slug;
        const data = { comment, rating, user_id, slug };
        axios.post('/api/make-review/' + slug, data).then(({ data }) => {
            console.log(data.data);
            setReviewList([...review, data.data]);
            setComment('');
            setRating(0);
            setLoader(false);
        }).catch(error => {
            console.log(error.response.data)
        }
        )
    }
    return (
        <>
            <div className='mt-4'>
                <small className='d-block fw-bold'>{window.locale === 'mm' ? 'မှတ်ချက်များ' : 'Reviews'}</small>
                {reviewList.map(d => (
                    <div className='card mt-2 p-2' key={d.id}>
                        <div className='row'>
                            <div className='col-3'>
                                <img src={d.user.image_url} className='img-thumbnail'></img>
                            </div>
                            <div className='col-9'>
                                <StarRatings
                                    starDimension="20px"
                                    rating={d.rating}
                                    starRatedColor='#3A8BCD'
                                    numberOfStars={5}
                                />
                                <b className='d-block'>{d.user.name}</b>
                                <p className='text-wrap overflow-auto mt-1'>{ d.review }</p>
                            </div>
                        </div>
                    </div>
                ))}
                {window.auth &&
                    <div className='mt-3'>
                        {loader && <Spinner />}
                        {!loader && (
                            <div className='card p-3'>
                            <h5 className='card-title'>{window.locale === 'mm' ? 'မှတ်ချက်ပြုရန်' : 'Make Review'}</h5>
                            <StarRatings
                                rating={rating}
                                starDimension="28px"
                                starRatedColor='#3A8BCD'
                                starHoverColor="#3A8BCD"
                                changeRating={(rateCount)=> { setRating(rateCount)} }
                                numberOfStars={5}
                            />
                            <div>
                                <textarea
                                    value={comment}
                                    rows={4}
                                    className='form-control mt-1'
                                    placeholder={window.locale === 'mm' ? 'မှတ်ချက်ရေးရန်' : 'Enter Review'}
                                    onChange={(e) => {setComment(e.target.value)}}
                                ></textarea>
                                <button className='btn btn-primary btn-dark mt-3 float-end'
                                    onClick={() => { makeReview() }}
                                    disabled={disabledReview}
                                >{window.locale === 'mm' ? 'မှတ်ချက်ပြုမည်' : 'Review'}</button>
                            </div>
                        </div>
                        )}
                    </div>
                }
            </div>
        </>
    )
}
