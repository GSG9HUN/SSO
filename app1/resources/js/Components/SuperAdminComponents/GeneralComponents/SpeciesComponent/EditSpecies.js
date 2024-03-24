import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";
import Select from "react-select";


export default class EditSpecies extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            speciesName:this.props.toEdit.name,
            hair_type:this.props.toEdit.hair_type,
            selectedAnimalCategory: '',
            animalCategoryOptions:[],
            errors: ''
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.getAnimalCategoryOptions = this.getAnimalCategoryOptions.bind(this)
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
            speciesName:this.state.speciesName,
            category_id:this.state.selectedAnimalCategory['value'],
            hair_type:this.state.hair_type
        }).then(()=>{
            this.closeBut.click()
        }).catch((errors)=>{
            this.setState({
                errors:errors.response.data.errors
            })
        })
    }

    getAnimalCategoryOptions(){
        axios.get('/api/SelectSearch/species').then((response)=>{
            let foundAnimalCategory = response.data.animalCategoryOptions.find(animalCategory=>{
                return animalCategory['value'] === this.props.toEdit.category_id;
            })

            this.setState({
                animalCategoryOptions:[...response.data.animalCategoryOptions],
                selectedAnimalCategory  : foundAnimalCategory
            })
        })
    }


    componentDidMount() {
        this.getAnimalCategoryOptions()
    }

    render() {
        return (
            <form onSubmit={this.handleSubmit}>
                {
                    this.state.errors &&
                    <ErrorWriter errors={this.state.errors}/>
                }
                <div className={'form-item'}>
                    <label>Állatfaj megnevezése</label>
                    <input type={'text'} onChange={this.handleChange} name={'speciesName'}
                           value={this.state.speciesName}/>
                </div>

                <div className={'form-item'}>
                    <label>Állat</label>

                    <Select
                        options={this.state.animalCategoryOptions}
                        onChange={this.handleSelectChange}
                        value={this.state.selectedAnimalCategory}
                    />
                </div>

                <div className={'form-item'}>
                    <label>Szőrzet típusa(hosszú,közepes,rövid)</label>
                    <input type={'text'} onChange={this.handleChange} name={'hair_type'}
                           value={this.state.hair_type}/>
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
