import React from "react";

export default class AddInvitation extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            role_id:'2',
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
        axios.post('/api/invitations', {
            email: this.state.email,
            role_id:this.state.role_id
        }).then((response) => {
            this.closeBut.click()
        }).catch((err) => {
            console.log(err)
        })
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                <h2>
                    Menhely meghívása
                </h2>

                <div className={'form-item'}>
                    <label>E-mail cím</label>
                    <input type={'email'} value={this.state.email} name={'email'} onChange={this.handleChange}
                           placeholder={'email'}/>
                </div>
                <div className={'form-item'}>
                    <button type={'submit'}>Küldés</button>
                    <button type={'button'} onClick={this.props.closeModal} ref={ref => {this.closeBut = ref}}>Mégse
                    </button>
                </div>
            </form>
        )
    }
}
