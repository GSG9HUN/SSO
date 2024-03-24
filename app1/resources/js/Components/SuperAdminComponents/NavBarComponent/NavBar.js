import React, {useState} from "react";
import * as navBarElements from './NavBarElements'
import ReactDOM from "react-dom";


const NavBar = () => {
    let navData = navBarElements['navBarElements'];

    const [isActive, setIsActive] = useState(false);
    return (
        <ul className="nav">
            {navData.map((data, index) => {
                if (data.subNav) {
                    return (
                        <React.Fragment key={index}>
                            <li style={{display: 'flex'}} key={index}>
                                <a href={data.path}>
                                    <img style={{width: 20, height: 20}} src={data.src} alt={data.alt}/>
                                    <span style={{marginLeft: 10}}>{data.title}</span>
                                </a>
                            </li>
                            <ul className="subNav">
                                {
                                    data.subNav.map((sub, index2) => {
                                        return (
                                            <li style={{display: 'flex'}} key={index2+''+index}>
                                                <a href={sub.path}>
                                                    <img style={{width: 20, height: 20}} src={sub.src} alt={sub.alt}/>
                                                    <span style={{marginLeft: 10}}>{sub.title}</span>
                                                </a>
                                            </li>
                                        )
                                    })
                                }
                            </ul>
                        </React.Fragment>

                    )

                }
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
if (document.getElementById('nav-bar')) {
    ReactDOM.render(<NavBar/>, document.getElementById('nav-bar'))
}
