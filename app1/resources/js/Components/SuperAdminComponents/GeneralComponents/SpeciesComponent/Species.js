import React from "react";
import ReactDOM from "react-dom";
import SpeciesModal from "./SpeciesModal";
import Pagination from "react-js-pagination";

export default class Species extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            species: [],
            total: 0,
            perPage: 0,
            currentPage: 1,
        }
        this.getSpecies = this.getSpecies.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
        this.renderSpecies = this.renderSpecies.bind(this)
        this.reRenderSpecies = this.reRenderSpecies.bind(this)
    }

    getSpecies(pageNumber = 1) {
        axios.get(`/api/species?page=${pageNumber}`).then((response) => {
            this.setState({
                species: response.data.species.data,
                total: response.data.species.total,
                perPage: response.data.species.per_page,
                currentPage: response.data.species.current_page
            })
        })
    }

    renderSpecies() {
        return this.state.species.map((specie, index) => {
            return (
                <tr key={index}>
                    <td>{specie.id}</td>
                    <td>{specie.name}</td>
                    <td>{specie.category.name}</td>
                    <td>{specie.hair_type}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <SpeciesModal reRenderSpecies={this.reRenderSpecies} toEdit={specie}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(specie.id)
                                }}>Törlés
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            )
        })
    }

    reRenderSpecies() {
        this.getSpecies()
    }

    componentDidMount() {
        this.getSpecies()
    }

    handleDelete(id) {
        axios.delete(`/api/species/${id}`).then(() => {
            this.renderSpecies()
        })
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Faj név</th>
                        <th>Állat név</th>
                        <th>Szőr típusa</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderSpecies()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <SpeciesModal reRenderSpecies={this.reRenderSpecies}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getSpecies(pageNumber)
                        }}
                        itemsCountPerPage={this.state.perPage}
                        totalItemsCount={this.state.total}
                        activePage={this.state.currentPage}
                    />
                </div>
            </div>
        )
    }
}

if (document.getElementById('general.species')) {
    ReactDOM.render(<Species/>, document.getElementById('general.species'))
}
