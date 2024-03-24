import React from "react";

export default class AddAnimals extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            name: '',
            species_id: '',
            sex_id: '',
            size_id: '',
            color_id: '',
            age: '',
            description: '',
            mix: false,
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
        axios.post('/api/animals', {
            name: this.state.name,
            species_id: this.state.species_id,
            sex_id: this.state.sex_id,
            size_id: this.state.size_id,
            color_id: this.state.color_id,
            age: this.state.age,
            description: this.state.description,
            mix: this.state.mix,
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
                    Új állat hozzáadása
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
