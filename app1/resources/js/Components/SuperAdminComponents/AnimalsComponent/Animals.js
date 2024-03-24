import React from "react";
import ReactDOM from "react-dom";
import AnimalsModal from "./AnimalsModal";


export default class Animals extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            animals: [],
        }

        this.renderAnimals = this.renderAnimals.bind(this)
        this.reRenderAnimals = this.reRenderAnimals.bind(this)
        this.getAnimals = this.getAnimals.bind(this)

    }


    getInvitations() {
        axios.get('/api/animals'
        ).then((response) => {
            this.setState({
                animals:[...response.data.animals]
            })
        })
    }

    reRenderAnimals() {
        this.getAnimals()
    }


    renderAnimals() {
        return this.state.animals.map((animal, index) => {
            return(
                <tr key={index}>
                    <td>{animal.id}</td>
                    <td>{animal.name}</td>
                    <td>{animal.species.name}</td>
                    <td>{animal.sex.name}</td>
                    <td>{animal.size.name}</td>
                    <td>{animal.color.name}</td>
                    <td>{animal.age}</td>
                    <td>{animal.descirption}</td>
                    <td>{animal.mix?'keverék':'faj tiszta'}</td>
                </tr>
            )
        })
    }

    componentDidMount() {
        this.getInvitations();
    }

    render() {
        return (
            <div>
                <table className={'data-table'}>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Név</th>
                            <th>Faj név</th>
                            <th>Nem</th>
                            <th>Méret</th>
                            <th>Szín</th>
                            <th>Kor</th>
                            <th>Leírás</th>
                            <th>Keverék/Faj tiszta</th>
                        </tr>
                    </thead>
                    <tbody>
                    {this.renderAnimals()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <AnimalsModal reRenderAnimals ={this.reRenderAnimals}/>
                </div>
            </div>
        )
    }

}

if (document.getElementById('invitations')) {
    ReactDOM.render(<Animals/>, document.getElementById('invitations'))
}
