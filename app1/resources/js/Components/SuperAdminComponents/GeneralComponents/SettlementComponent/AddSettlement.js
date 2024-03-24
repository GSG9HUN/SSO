import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";
import Select from "react-select";


export default class AddCounties extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            settlementName:'',
            selectedCounty: '',
            countyOptions:[],
            errors: ''
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.getCountyOptions = this.getCountyOptions.bind(this)
        this.handleSelectChange = this.handleSelectChange.bind(this)
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleSelectChange(selectedCounty){
        this.setState({
            selectedCounty:selectedCounty
        })
    }

    handleSubmit(e) {
        e.preventDefault()
        axios.post('/api/settlement', {
            settlementName: this.state.settlementName,
            countyId: this.state.selectedCounty['value'],
        }).then(() => {
            this.closeBut.click()
        }).catch((err) => {
            this.setState({errors: err.response.data.errors})
        })
    }

    getCountyOptions(){
        axios.get('/api/SelectSearch/county').then((response)=>{
            this.setState({
                countyOptions:[...response.data.countyOptions]
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
                    <label>Település neve</label>
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
