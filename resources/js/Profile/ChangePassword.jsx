import axios from 'axios';
import React, { useRef, useState} from 'react';
import SmallSpinner from '../Component/SmallSpinner';

const ChangePassword = () => {
  const [loader, setLoader] = useState(false);
  let currentPasswordRef = useRef('');
  let newPasswordRef = useRef('');
  let confirmPasswordRef = useRef('');

  const user_id = window.auth.id;


  const changePassword = () => {
    setLoader(true);

    let currentPassword = currentPasswordRef.current.value;
    let newPassword = newPasswordRef.current.value;
    let confirmPassword = confirmPasswordRef.current.value;

    const clearInput = () => {
      currentPasswordRef.current.value = '';
      newPasswordRef.current.value = '';
      confirmPasswordRef.current.value = '';
    }

    //check new & current password do exist
    if (newPassword === '' || currentPassword === '') {
      showToastError('Please enter passwords');
      return clearInput();
    }

    //check whether current is equal to new Password
    if (currentPassword === newPassword) {
      showToastError('You can use old password again');
      return clearInput();
    }

    //check whether new is equal to confirm Password
    if (newPassword !== confirmPassword) {
      showToastError('Passwords do not match');
      clearInput();
    } else {
      axios.post(`/api/change-password?user_id=${user_id}`, { currentPassword, newPassword })
        .then(res => {
          clearInput();
          setLoader(false);
          if (res.data.message === false) {
            showToastError('Wrong current Password');
          } else {
            showToastSuccess('Changed Password successfully');
          }
        })
    }
  }

  return (
    <div className='container py-5'>
      <div className='row'>
        <div className='col-lg-6 offset-lg-3'>
          <div className='card px-5 py-4'>
            <h3>Change Password</h3>
            <div className='form-group my-2 mt-3'>
              <label>Enter current Password</label>
              <input type='password' className='form-control'
                ref={currentPasswordRef}/>
            </div>
            <div className='form-group my-2'>
              <label>Enter new Password</label>
              <input type='password' className='form-control'
                ref={newPasswordRef}/>
            </div>
            <div className='form-group my-2'>
              <label>Confirm new Password</label>
              <input type='password' className='form-control'
                ref={confirmPasswordRef}/>
            </div>
            <div>
              <button className='btn btn-dark float-end mt-3'
                onClick={() => { changePassword() }}>{ loader && <SmallSpinner/>}Change</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  )
}

export default ChangePassword
