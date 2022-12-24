import React, { useState } from 'react';
import axios from "axios";
import SmallSpinner from '../../../Component/SmallSpinner'

const ProfileName = () => {
    const styles = {
        pen: {
                fontSize: 14,
                bottom: 7,
        },
    }

    const user = window.auth;
    const user_id = user.id;
    const [displayName, setDisplayName] = useState(user.display_name);
    const [miniLoader, setMiniLoader] = useState('');

    // update user name
    const updateUserToApi = () => {
        setMiniLoader('name');
        const dataToApi = $('#userInput').val();
        axios.post('/api/update-user_info/' + user_id, { dataToApi })
            .then(res => {
                setDisplayName(res.data.data);
                setMiniLoader(false);
                $('#userNameEditInput').toggleClass('d-none');
                $('#userName').toggleClass('d-none');
            });
    }

    //toggle editing user name
    const updateName = () => {
        const editUserName = displayName;

        $('#userName').toggleClass('d-none');

        if ($('#userNameEditInput').length > 0) {
            $('#userNameEditInput').toggleClass('d-none');
        } else {
            $(`<div id='userNameEditInput'>
                <input type='text' class='mt-3 mb-2' id='userInput'> <i class='fa-solid fa-check'></i>
            </div>`).appendTo('#updateUserName');
            $('#userInput').val(editUserName);
            $('#userInput').width(editUserName.length + 'em');
            $('.fa-check').click(() => { updateUserToApi(editUserName) });
        }
    }

  return (
    <div id='updateUserName'>
        <div id='userName'>
            {miniLoader == 'name' && <SmallSpinner/>}
            <h5 className="my-3 position-relative">{displayName}
                <i className="fa-solid fa-pen position-absolute ms-2" style={styles.pen}
                    onClick={() => {updateName()}}></i>
            </h5>
        </div>
    </div>
  )
}

export default ProfileName
