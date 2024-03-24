import React from 'react';
import Modal from 'react-modal';
import EditCountiesModal from "./EditCountiesModal";
import AddCounties from "./AddCounties";

export default class CountiesModal extends React.Component{
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
        this.props.reRenderCounties()
    }

    createEditForm() {
        return [
            <EditCountiesModal closeModal={this.closeModal} toEdit={this.props.toEdit}/>,
            <button onClick={this.openModal}>Megye módosítása</button>
        ]
    }

    createAddForm() {
        return [
            <AddCounties closeModal={this.closeModal}/>,
            <button className={'animated-button'} onClick={this.openModal}>Új megye hozzáadás</button>
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
                    contentLabel="Megye"
                    ariaHideApp={false}
                >
                    <h2>Hello</h2>
                    {form}
                </Modal>
            </div>
        );
    }

}

