import React from "react";
import * as navBarElements from './NavBarElements'
import ReactDOM from "react-dom";

const NavBar = () => {
    let navData = navBarElements['navBarElements'];

    return (
        <ul className="nav">
            {navData.map((data, index) => {
                return (
                    <li style={{display: 'flex'}} key={index}>
                        <a href={data.path}>
                            <img style={{width: 20, height: 20}} src={data.src} alt={data.alt}/>
                            <span style={{marginLeft: 10}}>{data.title}</span>
                        </a>
                    </li>
                )
            })}
        </ul>
    )
}
if (document.getElementById('admin-nav-bar')) {
    ReactDOM.render(<NavBar/>, document.getElementById('admin-nav-bar'))
}
