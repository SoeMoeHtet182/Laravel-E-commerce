import React, {useState} from 'react';
import axios from "axios";
import SmallSpinner from '../../../Component/SmallSpinner';

const ProfileImage = () => {
    const styles = {
        uploadBtn: {
            backgroundColor: 'rgb(237, 234, 234)',
            border: '1px solid black',
            borderRadius: 3,
            padding: 2,
        }
    }

    const user = window.auth;
    const user_id = user.id;
    const [userImage, setUserImage] = useState(user.image_url);
    const [miniLoader, setMiniLoader] = useState('');

     // upload user image
    const uploadImage = (e) => {
        $('#profile-image').toggleClass('d-none');
        setMiniLoader('image');
        const file = e.target.files[0];
        const formData = new FormData();
        formData.append('file', file);
        axios({
            method: 'post',
            url: '/api/update-user_info/' + user_id,
            data: formData,
        }).then(res => {
            setUserImage(res.data);
            setMiniLoader(false);
            $('#profile-image').toggleClass('d-none');
        })
    }
    return (
    <>
        <div style={{ marginBottom: '10px' }}>
            {miniLoader== 'image' && <SmallSpinner />}
            <img src={userImage}  id='profile-image' className="rounded-circle img-fluid" style={{ width: '150px', height: '150px' }} />
        </div>
        <div>
            <a style={styles.uploadBtn}>
                <label htmlFor="files"><small>{window.locale === 'mm' ? 'ဓာတ်ပုံတင်ရန်' : 'Upload Image'}</small> </label>
                <input id="files" hidden type="file" onChange={ (e) => {uploadImage(e)} } />
            </a>
        </div>
    </>
  )
}

export default ProfileImage
