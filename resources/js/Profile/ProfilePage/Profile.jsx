import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import ProfileImage from './Item/ProfileImage';
import ProfileName from './Item/ProfileName';
import Spinner from '../../Component/Spinner';
import '../../../css/profile.css';

const Profile = () => {
    const user_id = window.auth.id;
    const [user, setUser] = useState();
    const [loader, setLoader] = useState(true);

    useEffect(() => {
        axios.get(`/api/user_profile?user_id=${user_id}`)
            .then(res => {
                if (res.data.message === false) {
                    showToastError('User not found');
                } else {
                    setUser(res.data.data);
                    setLoader(false);
                }
            })
    }, []);

    return (
        <>
            {loader && <Spinner />}
            {!loader &&
                <>
                     <div className="container py-5">
                        <div className="row">
                            <div className="col-md-4">
                                <div className="card mb-4">
                                    <div className="card-body text-center">
                                        <ProfileImage />
                                        <ProfileName />
                                        <b className="text-muted mb-4">{ user.level.level}</b>
                                        <div className="d-flex justify-content-center m-2" id='change-password'>
                                            <button className="btn btn-outline-primary"><Link to='/change-password'>{window.locale === 'mm' ? 'စကားဝှက်ပြောင်းရန်' : 'Change Password'}</Link></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-lg-8">
                                <div className="card mb-4">
                                    <div className="card-body">
                                        <div className="row">
                                            <div className="col-sm-3">
                                                <p className="mb-0">{window.locale === 'mm' ? 'နာမည်ရင်း' : 'Full Name'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                                <p className="text-muted mb-0">{user.full_name}</p>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div className="row">
                                            <div className="col-sm-3">
                                                <p className="mb-0">{window.locale === 'mm' ? 'စခရင်နာမည်' : 'Display Name'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                            <p className="text-muted mb-0">{ user.display_name }</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <div className="row">
                                            <div className="col-sm-3">
                                                <p className="mb-0">{window.locale === 'mm' ? 'အီးမေးလ်' : 'Email'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                                <p className="text-muted mb-0">{user.email }</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <div className="row">
                                            <div className="col-sm-3">
                                            <p className="mb-0">{window.locale === 'mm' ? 'ဖုန်းနံပါတ်' : 'Phone'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                                <p className="text-muted mb-0">{user.phone}</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <div className="row">
                                            <div className="col-sm-3">
                                            <p className="mb-0">{window.locale === 'mm' ? 'မြို့' : 'City'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                            <p className="text-muted mb-0">{user.city}</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <div className="row">
                                            <div className="col-sm-3">
                                            <p className="mb-0">{window.locale === 'mm' ? 'စာတိုက်အမှတ်' : 'Postal Code'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                            <p className="text-muted mb-0">{user.postal_code}</p>
                                            </div>
                                        </div>
                                        <hr />
                                        <div className="row">
                                            <div className="col-sm-3">
                                            <p className="mb-0">{window.locale === 'mm' ? 'လိပ်စာ' : 'Address'}</p>
                                            </div>
                                            <div className="col-sm-9">
                                            <p className="text-muted mb-0">{user.address}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href='/logout'>
                                    <button className='btn btn-danger ms-2 float-end'>{window.locale === 'mm' ? 'ထွက်ရန်' : 'Log out'}</button>
                                </a>
                                <a href={'/edit-user_info/'+ user_id}>
                                    <button className='btn btn-primary float-end'>{window.locale === 'mm' ? 'ပြင်ဆင်ရန်' : 'Edit'}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </>
            }
        </>
    )
}

export default Profile
