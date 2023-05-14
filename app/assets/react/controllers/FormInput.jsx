import React, {useState} from 'react';

export default function (props) {
    return(
        <div className={"form-input"}>
            <label className={"form-input__label"} htmlFor={props.fieldName + '-input'}>{props.fieldTitle}</label>
            <input className={"form-input__input"} placeholder={props.fieldTitle} defaultValue={props.fieldValue} id={props.fieldName + '-input'} name={props.fieldName} />
        </div>
    );
}
