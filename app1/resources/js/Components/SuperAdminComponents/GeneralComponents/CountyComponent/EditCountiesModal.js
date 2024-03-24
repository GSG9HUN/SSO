import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";


export default class EditCountiesModal extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            county: this.props.toEdit.name,
            errors:''
        }

        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
    }

    handleChange(e){
        this.setState({
            [e.target.name]:e.target.value
        })
    }

    handleSubmit(e){
        e.preventDefault()
        axios.put(`/api/counties/${this.props.toEdit.id}`,{
            county:this.state.county
        }).then(()=>{
            this.closeBut.click()
        }).catch((errors)=>{
            this.setState({
                errors:errors.response.data.errors
            })
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
                    <label>Megye</label>
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
