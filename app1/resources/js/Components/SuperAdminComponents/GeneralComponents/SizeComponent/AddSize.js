import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";


export default class AddSize extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            size: '',
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
        axios.post('/api/size', {
            size: this.state.size
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
                    <label>Méret</label>
                    <input type={'text'} onChange={this.handleChange} name={'size'}
                           value={this.state.size}/>
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
