import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";
import Select from "react-select";


export default class EditSettlement extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            settlementName: this.props.toEdit.name,
            selectedCounty:'',
            countyOptions:[],
            errors:''
        }

        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleChange = this.handleChange.bind(this)
        this.getCountyOptions = this.getCountyOptions.bind(this)
        this.handleSelectChange = this.handleSelectChange.bind(this)
    }


    handleChange(e){
        this.setState({
            [e.target.name]:e.target.value
        })
    }

    handleSelectChange(selectedCounty){
        this.setState({
            selectedCounty:selectedCounty
        })
    }

    handleSubmit(e){
        e.preventDefault()
        axios.put(`/api/settlement/${this.props.toEdit.id}`,{
            settlementName:this.state.settlementName,
            countyId:this.state.selectedCounty['value']
        }).then(()=>{
            this.closeBut.click()
        }).catch((errors)=>{
            this.setState({
                errors:errors.response.data.errors
            })
        })
    }

    getCountyOptions(){
        axios.get('/api/SelectSearch/county').then((response)=>{
            let foundCounty = response.data.countyOptions.find(county=>{
                return county['value'] === this.props.toEdit.county_id;
            })

            this.setState({
                countyOptions:[...response.data.countyOptions],
                selectedCounty  : foundCounty
            })
        })
    }


    componentDidMount() {
        this.getCountyOptions()
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                {
                    this.state.errors &&
                    <ErrorWriter errors={this.state.errors}/>
                }
                <div className={'form-item'}>
                    <label>Település</label>
                    <input type={'text'} onChange={this.handleChange} name={'settlementName'}
                           value={this.state.settlementName}/>
                </div>

                <div className={'form-item'}>
                    <label>Megye</label>

                    <Select
                        options={this.state.countyOptions}
                        onChange={this.handleSelectChange}
                        value={this.state.selectedCounty}
                    />
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
