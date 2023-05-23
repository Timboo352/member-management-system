import React, {useState} from 'react';

export default function (props) {
    return(
        <a href={props.path} className="status-preview__link">
            <div className="status-preview" style={{borderColor: props.color}}>
                <div className="status-preview__title">
                    {props.title}
                </div>
            </div>
        </a>
    );
}
