import axios from 'axios';
import React from 'react';
import { useState, useEffect } from 'react';
import Spinner from '../Component/Spinner';
import ViewAndLike from '../Component/ViewAndLike';

export default function Home() {
    const styles = {
        card: {
            width: '10rem',
            textOverflow: 'ellipsis',
        },
        cardImg: {
            maxWidth: '211px',
            height: '200px'
        },
        lineTrough: {
            display: 'inline',
            textDecoration: 'line-through black 2px'
        }
    };
    const [featuredProducts, setFeaturedProducts] = useState([]);
    const [productByCategory, setProductByCategory] = useState([]);
    const [loader, setLoader] = useState(true);
    const [checkProduct, setCheckProduct] = useState(false);
    const [likeCss, setLikeCss] = useState('');

        useEffect(() => {
            axios.get('/api/home')
                .then(d => {
                    const { featuredProducts, productByCategory } = d.data.data;
                    setFeaturedProducts(featuredProducts);
                    setProductByCategory(productByCategory);
                    setLikeCss(d.data.css);
                    setLoader(false);
                })
                .catch(err => {
                    setFeaturedProducts([]);
                    setProductByCategory([]);
                    setLoader(false);
                });
        },[]);

  return (
      <>
          {loader && <Spinner />}
          {!loader && (
              <>
                  {checkProduct && (<></>)}
                  {!checkProduct && (
                      <>
                        <div className="container">
                            <div className="row">
                                <div className="col-md-12">
                                    <div className="section-heading">
                                        <div className="line-dec" />
                                          <h1>{ window.locale === 'mm' ? 'အထင်ကရပစ္စည်းများ' : 'Featured Items' }</h1>
                                    </div>
                                </div>
                                <div className="col-md-12">
                                    <div className="row">
                                        {featuredProducts.map(d => (
                                            <a href={`/products/detail/${d.slug}`} className="col" key={d.slug}>
                                                <div className='card p-3 m-2'>
                                                    <div style={{height: '235px',alignItems: 'center', display: 'grid'}}>
                                                        <img src={d.image_url} alt="Item 1" className='card-img-top' style={styles.cardImg}/>
                                                    </div>
                                                    <div className='card-body'>
                                                        <div className='card-text text-nowrap overflow-hidden text-black' style={styles.card}>{ d.name }</div>
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
                                                        <ViewAndLike view={d.view_count} like={d.like_count} product={ d.slug} />
                                                    </div>
                                                </div>
                                            </a>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {productByCategory.map(d => (
                            <div className="container" key={d.slug}>
                                <div className="row">
                                    <div className="col-md-12">
                                        <div className="section-heading">
                                            <div className="line-dec" />
                                            <a href={`products?category=${d.slug}`}><h1>{ window.locale === 'mm' ? d.mm_name : d.name  }</h1></a>
                                        </div>
                                    </div>
                                    <div className="col-md-12">
                                        <div className="row">
                                            {d.product.map(d => (
                                                <a href={`/products/detail/${d.slug}`} className="col" key={d.slug}>
                                                    <div className='card p-3 m-2'>
                                                        <div style={{height: '235px',alignItems: 'center', display: 'grid'}}>
                                                            <img src={d.image_url} alt="Item 1"  style={styles.cardImg}/>
                                                        </div>
                                                        <div className='card-body'>
                                                            <div className='card-text text-nowrap overflow-hidden text-black' style={styles.card}>{ d.name }</div>
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
                                                            <ViewAndLike view={d.view_count} like={d.like_count} product={d.slug} />
                                                        </div>
                                                    </div>
                                                </a>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                      </>
                  )}
              </>
          )}
    </>
  )
}
