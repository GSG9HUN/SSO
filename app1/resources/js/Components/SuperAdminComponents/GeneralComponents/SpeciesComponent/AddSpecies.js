import React from "react";
import {ErrorWriter} from "../../../ErrorWriter";
import Select from "react-select";


export default class AddSpecies extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            speciesName:'',
            selectedAnimalCategory: '',
            hair_type:'',
            animalCategoryOptions:[],
            errors: ''
        }
        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.getAnimalCategoryOptions = this.getAnimalCategoryOptions.bind(this)
        this.handleSelectChange = this.handleSelectChange.bind(this)
    }

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
    }

    handleSelectChange(selectedAnimalCategory){
        this.setState({
            selectedAnimalCategory:selectedAnimalCategory
        })
    }

    handleSubmit(e) {
        e.preventDefault()
        axios.post('/api/settlement', {
            speciesName: this.state.settlementName,
            category_id: this.state.selectedAnimalCategory['value'],
            hair_type:this.state.hair_type
        }).then(() => {
            this.closeBut.click()
        }).catch((err) => {
            this.setState({errors: err.response.data.errors})
        })
    }

    getAnimalCategoryOptions(){
        axios.get('/api/SelectSearch/category').then((response)=>{
            this.setState({
                animalCategoryOptions:[...response.data.animalCategoryOptions]
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
                    <label>Áttafaj megnevezése</label>
                    <input type={'text'} onChange={this.handleChange} name={'speciesName'}
                           value={this.state.speciesName}/>
                </div>


                <div className={'form-item'}>
                    <label>Megye</label>
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
