import React, {useState} from 'react';

export default function (props) {
    const [inputValue, setInputValue] = useState(props.fieldValue);
    const validateInput = (event) => {
        const value = event.target.innerHTML;
        const cleanedValue = value.replace(/<.*?>/g, '').replace(/&.*?;/g, '').trim();
        setInputValue(cleanedValue);
        event.target.innerHTML = inputValue;
    }
    return(
        <div className={"inline-input__wrapper"}>
            <span
                id={props.fieldName}
                className={"inline-input"}
                placeholder={props.fieldTitle}
                contentEditable={true}
                onBlur={validateInput}
            >{inputValue}</span>
            <input value={inputValue} readOnly={true} hidden={true} id={props.fieldName + '-input'} name={props.fieldName} />
            <i className="inline-input__icon fa-solid fa-pen-to-square"></i>
        </div>
    );
}
