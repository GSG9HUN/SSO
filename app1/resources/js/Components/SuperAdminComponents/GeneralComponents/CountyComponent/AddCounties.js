import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";


export default class AddCounties extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            county: '',
            errors: ''
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleSubmit(e) {
        e.preventDefault()
        axios.post('/api/counties', {
            county: this.state.county
        }).then(() => {
            this.closeBut.click()
        }).catch((err) => {
            this.setState({errors: err.response.data.errors})
        })
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                {
                    this.state.errors &&
                    <ErrorWriter errors={this.state.errors}/>
                }
                <div className={'form-item'}>
                    <label>Megye név</label>
                    <input type={'text'} onChange={this.handleChange} name={'county'}
                           value={this.state.county}/>
                </div>

                <div className={'form-buttons'}>
                    <button type={'submit'} onClick={this.handleSubmit}>Mentés</button>
                    <button type={'button'} onClick={this.props.closeModal} ref={ref => this.closeBut = ref}>Mégse
                    </button>
                </div>
            </form>
        )
    }
}
