
import axios from 'axios';
import React, { useEffect, useState } from 'react'
import SmallSpinner from '../Component/SmallSpinner';
import Spinner from '../Component/Spinner';
import ViewAndLike from '../Component/ViewAndLike';
import Review from './Review/Review';

export default function ProductDetail() {
    const styles = {
        whAuto: {
            width: '100%',
            height: '100%'
        },
        lineTrough: {
            display: 'inline',
            textDecoration: 'line-through black 2px'
        },
    }
    const [product, setProduct] = useState([]);
    const [randomProducts, setRandomProducts] = useState([]);
    const [loader, setLoader] = useState(true);
    const [quantity, setQuantity] = useState(1);
    const [cartLoader, setCartLoader] = useState(false);
    const [likeCss, setLikeCss] = useState('');

    if (window.auth) {
        const user = window.auth;
        useEffect(() => {
            axios.get('/api/product/detail/' + window.product_slug + '?user_id=' + user.id).then((d) => {
                setProduct(d.data.data.product);
                setRandomProducts(d.data.data.randomProducts);
                setLikeCss(d.data.css);
                setLoader(false);
            });
        }, []);
    } else {
        useEffect(() => {
            axios.get('/api/product/detail/' + window.product_slug).then((d) => {
                setProduct(d.data.data.product);
                setRandomProducts(d.data.data.randomProducts);
                setLikeCss(d.data.css);
                setLoader(false);
            });
        }, []);
    }

    const addToCart = () => {
        if (!window.auth) {
            return showToastError('Please login first to order');
        }
        setCartLoader(true);
        const user_id = window.auth.id;
        const product_slug = window.product_slug;
        const data = { user_id, product_slug, quantity };
        axios.post('/api/add-to-cart/' + product_slug, data).then(({ data }) => {
            if (!data.message) {
                setQuantity(1);
                showToastError('Product not found');
                setCartLoader(false);
            } else {
                setQuantity(1);
                showToastSuccess('Added to cart successfully');
                updateCart(data.data);
                setCartLoader(false);
            }
        })
    }

    return (
      <>
          {loader && <Spinner/>}
          {!loader && (
              <>
                {/* Page Content */}
                {/* Single Starts Here */}
                <div className="single-product">
                    <div className="container">
                        <div className="row">
                            <div className="col-md-12">
                            <div className="section-heading">
                                <div className="line-dec" />
                                    <h1>{ product.name }</h1>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className='card p-3' style={{ width: '498px', height: '514px' }}>
                                    <div id="carouselExampleIndicators" className="carousel carousel-dark slide" data-bs-ride="false" style={{width: '100%', height: '347px'}}>
                                        <div className="carousel-inner" style={styles.whAuto}>
                                            {product.images.map((d,index) => (
                                                <div className={`${index == 0 && 'active'} carousel-item`} style={styles.whAuto} key={d.id}>
                                                <img src={d.image_url} className="d-block m-auto" width='320px' height='100%' style={{objectFit: 'fill'}}/>
                                            </div>
                                            ))}
                                        </div>
                                        <button className="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span className="carousel-control-prev-icon" aria-hidden="true" />
                                            <span className="visually-hidden">Previous</span>
                                        </button>
                                        <button className="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span className="carousel-control-next-icon" aria-hidden="true" />
                                            <span className="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div className="mt-3">
                                        {product.images.map((d,index) => (
                                            <img src={d.image_url} data-bs-target="#carouselExampleIndicators" data-bs-slide-to={index}
                                                className="m-2 img-thumbnail" width='130px' height='105px'
                                                aria-current="true" aria-label="Slide 1" key={d.id} />
                                        ))}
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-6">
                                <div className="right-content">
                                    <h4>{product.name}</h4>
                                    {product.discount_price ? (<><h6 style={styles.lineTrough}>${product.sale_price}</h6>
                                            <h6 className='d-inline'> ${product.sale_price - product.discount_price}
                                                <b className='text-danger ms-3'>{(product.discount_price / product.sale_price * 100).toPrecision(2)}%off</b>
                                            </h6></>)
                                        : (<><h6>${ product.sale_price }</h6></>)}
                                    <p>{product.description}</p>
                                    <span>{product.total_quantity} <span className='text-dark'> { window.locale === 'mm' ? 'ခု ကျန်သေးသည်' : 'left on stock' }</span></span>
                                    <div className=''>
                                        <label htmlFor="quantity">{ window.locale === 'mm' ? 'ပမာဏ' :'Quantity' }:</label>
                                        <input name="quantity" type="number" min="1" className="quantity-text" id="quantity"
                                            onFocus={() => { if (this.value == '1') { this.value = ''; } }} onBlur={() => { if (this.value == '') { this.value = '1'; } }}
                                            onChange={e => setQuantity(e.target.value)} defaultValue={1} />
                                        <a className="btn btn-primary text-white ms-3" onClick={() => { addToCart() }} disabled={cartLoader}>
                                            {cartLoader && (
                                                <SmallSpinner/>
                                            )} {window.locale === 'mm' ? '‌ဈေးခြင်းထဲ ထည့်မည်' :'Add to Cart'}
                                        </a>
                                    </div>
                                    <div className="down-content">
                                        <div className="categories">
                                            <small className='d-block fw-bold'> {window.locale === 'mm' ? '‌အမျိုးအစား' :'Category'}:
                                                {product.category.map(d => (
                                                    <h6 className='d-inline' key={d.id}> {window.locale === 'mm' ? d.mm_name : d.name}:</h6>
                                                ))}
                                            </small>
                                            <small className='d-block fw-bold'>{window.locale === 'mm' ? 'တံဆိပ်' :'Brand'}:
                                                <h6 className='d-inline'> {product.brand.name} </h6>
                                            </small>
                                            <small className='d-block fw-bold'>{window.locale === 'mm' ? 'အရောင်' :'Color'}:
                                                {product.color.map(d => (
                                                    <h6 className='d-inline' key={d.id}> { d.name },</h6>
                                                ))}
                                            </small>
                                        </div>
                                        <ViewAndLike view={product.view_count} like={product.like_count} css={ likeCss} />
                                        <Review review={ product.review } />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/* Single Page Ends Here */}
                {/* Similar Starts Here */}
                <div className="">
                    <div className="container">
                        <div className="row">
                            <div className="col-md-12">
                                <div className="section-heading">
                                    <div className="line-dec" />
                                    <h1>{ window.locale === 'mm' ? 'သင်ကြိုက်နှစ်သက်နိုင်သည့် အခြားအရာများ' : 'You May Also Like' }</h1>
                                </div>
                            </div>
                            <div className="col-md-12">
                                <div className='d-flex justify-content-between'>
                                {randomProducts.map(d => (
                                    <div className='card p-3' style={{ width: "262.5px", height: '343px' }} key={d.slug}>
                                        <img src={d.image_url} style={{height: '200px'}} />
                                        <div className='card-body'>
                                            <div className='card-text text-nowrap overflow-hidden' style={styles.card}>{ d.name }</div>
                                            {d.discount_price ? (
                                                <h6 className='mt-2'>
                                                <span className='text-primary' style={styles.lineTrough}>
                                                    ${d.sale_price}
                                                </span>
                                                <span className='mx-2'>
                                                    ${d.sale_price - d.discount_price}
                                                    <b className='text-danger ms-2'>
                                                        {(d.discount_price / d.sale_price * 100).toPrecision(2)}% off
                                                    </b>
                                                </span>
                                            </h6>) : (
                                                <>
                                                    <h6 className='mt-2 text-primary'>${d.sale_price}</h6>
                                                </>
                                            )}
                                            <ViewAndLike view={d.view_count} like={d.like_count} css={ likeCss} />
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {/* Similar Ends Here */}
              </>
            )}
        </>
    )
}
