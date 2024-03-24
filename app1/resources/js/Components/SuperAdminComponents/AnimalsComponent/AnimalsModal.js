import React from 'react';
import Modal from 'react-modal';
import AddAnimals from './AddAnimals'

const customStyles = {
    content: {
        top: '50%',
        left: '50%',
        right: 'auto',
        bottom: 'auto',
        marginRight: '-50%',
        transform: 'translate(-50%, -50%)',
        backgroundColor:'gray',
        color:'black'
    },
};

export default class AnimalsModal extends React.Component{
    constructor(props) {
        super(props);
        this.state={
            open :false
        }

        this.openModal = this.openModal.bind(this)
        this.closeModal = this.closeModal.bind(this)

    }
    openModal(){
        this.setState({open:true});
    }

    closeModal(){
        this.setState({open:false});
        this.props.reRenderAnimals()
    }

    render() {
        return (
            <div>
                <button className={'animated-button'} onClick={this.openModal}>Új állat hozzáadása</button>
                <Modal
                    isOpen={this.state.open}
                    onRequestClose={this.closeModal}
                    style={customStyles}
                    contentLabel="Állat hozzáadása"
                    ariaHideApp={false}
                >
                    <h2>Hello</h2>
                    <AddAnimals closeModal={this.closeModal}/>
                </Modal>
            </div>
        );
    }

}

