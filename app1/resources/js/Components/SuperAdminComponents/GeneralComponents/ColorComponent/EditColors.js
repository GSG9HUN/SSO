import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";


export default class EditColors extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            color: this.props.toEdit.name,
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
        axios.put(`/api/colors/${this.props.toEdit.id}`,{
            color:this.state.color
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
                    <label>Szín</label>
                    <input type={'text'} onChange={this.handleChange} name={'color'}
                           value={this.state.color}/>
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
