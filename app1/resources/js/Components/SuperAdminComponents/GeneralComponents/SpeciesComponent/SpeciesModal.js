import React from 'react';
import Modal from 'react-modal';
import EditSpecies from "./EditSpecies";
import AddSpecies from './AddSpecies';

export default class SpeciesModal extends React.Component{
    constructor(props) {
        super(props);
        this.state={
            open :false
        }

        this.openModal = this.openModal.bind(this)
        this.closeModal = this.closeModal.bind(this)
        this.createAddForm = this.createAddForm.bind(this)
        this.createEditForm = this.createEditForm.bind(this)

    }
    openModal(){
        this.setState({open:true});
    }

    closeModal(){
        this.setState({open:false});
        this.props.reRenderSpecies()
    }

    createEditForm() {
        return [
            <EditSpecies closeModal={this.closeModal} toEdit={this.props.toEdit}/>,
            <button onClick={this.openModal}>Állatfaj módosítása</button>
        ]
    }

    createAddForm() {
        return [
            <AddSpecies closeModal={this.closeModal}/>,
            <button className={'animated-button'} onClick={this.openModal}>Új Állatfaj hozzáadás</button>
        ]
    }

    render() {
        let form,button;
        if(this.props.toEdit){
            [form,button] = this.createEditForm()
        }else{
            [form,button] = this.createAddForm()
        }

        return (
            <div>
                {button}
                <Modal
                    isOpen={this.state.open}
                    onRequestClose={this.closeModal}
                    className={'Modal small'}
                    contentLabel="Állatfaj"
                    ariaHideApp={false}
                >
                    <h2>Hello</h2>
                    {form}
                </Modal>
            </div>
        );
    }

}

