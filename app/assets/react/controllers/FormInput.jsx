import React, {useState} from 'react';

export default function (props) {
    var required = false;
    var inputType = 'text';
    if(typeof props.required !== "undefined" && props.required == true) {
        required = true;
    }
    if(typeof props.inputType !== "undefined") {
        inputType = props.inputType;
    }

    if (typeof props.disableLabel !== "undefined" && props.disableLabel == true) {
        return(
            <div className={"form-input"}>
                <input type={inputType} required={required} className={"form-input__input"} placeholder={props.fieldTitle} defaultValue={props.fieldValue} id={props.fieldName + '-input'} name={props.fieldName} />
            </div>
        );
    } else {
        return(
            <div className={"form-input"}>
                <label className={"form-input__label"} htmlFor={props.fieldName + '-input'}>{props.fieldTitle}</label>
                <input type={inputType} required={required} className={"form-input__input"} placeholder={props.fieldTitle} defaultValue={props.fieldValue} id={props.fieldName + '-input'} name={props.fieldName} />
            </div>
        );
    }
}
