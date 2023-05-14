import React, {useState} from 'react';

export default function (props) {
    const colorStyle = {
      backgroundColor: '#' + props.color,
    }
    return(
        <div className="member-status" style={{borderColor: '#' + props.color}}>
            <div className="member-status__title">{props.title}</div>
            <div className="member-status__color" style={colorStyle}></div>
        </div>
    );
}
