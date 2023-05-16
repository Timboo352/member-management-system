import React, {useState} from 'react';

export default function (props) {
    return(
        <a href="#">
            <div className="member-preview">
                <div className="member-preview__title">
                    <h2>{props.lastName} {props.firstName} | {props.nickname}</h2>
                </div>
            </div>
        </a>
    );
}
