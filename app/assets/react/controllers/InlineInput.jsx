import React, {useState} from 'react';

export default function (props) {
    return(
        <div className={"inline-input__wrapper"}>
            {/*TODO: auto width input*/}
            <input
                autoComplete="off"
                data-lpignore="true"
                id={props.fieldName}
                className={"inline-input"}
                type={"text"} name={props.fieldName}
                defaultValue={props.fieldValue}
                placeholder={props.fieldTitle}
            />
            <label htmlFor={props.fieldName}>
                <i className="inline-input__icon fa-solid fa-pen-to-square"></i>
            </label>
        </div>
    );
}
