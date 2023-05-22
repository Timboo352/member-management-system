import React, {useState} from 'react';

export default function (props) {
    return(
        <a href={props.path} className="member-preview__link">
            <div className="member-preview">
                <h2 className="member-preview__title">{props.lastName} {props.firstName} <small>| {props.nickname}</small></h2>
                <div className="member-preview__role__container">
                    <div className="member-preview__role__background" style={{background: "linear-gradient(90deg, rgba(0,0,0,0) 0%, #" + props.roleColor + " 100%)"}}></div>
                    <span className="member-preview__role__title" style={{color: "#" + props.roleColor}}>
                        {props.roleName}
                    </span>
                </div>
            </div>
        </a>
    );
}
