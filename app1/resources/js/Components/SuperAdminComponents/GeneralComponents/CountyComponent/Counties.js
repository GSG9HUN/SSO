import React from "react";
import ReactDOM from "react-dom";
import CountiesModal from "./CountiesModal";
import Pagination from "react-js-pagination";

export default class Counties extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            counties: [],
            perPage: 0,
            total: 0,
            currentPage: 1,
        }
        this.getCounties = this.getCounties.bind(this)
        this.renderCounties = this.renderCounties.bind(this)
        this.reRenderCounties = this.reRenderCounties.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }

    getCounties(pageNumber = 1) {
        axios.get(`/api/counties?page=${pageNumber}`).then((response) => {
            this.setState({
                counties: response.data.counties.data,
                perPage: response.data.counties.per_page,
                total: response.data.counties.total,
                currentPage: response.data.counties.current_page
            })
        })
    }

    renderCounties() {
        return this.state.counties.map((county, index) => {
            return (
                <tr key={index}>
                    <td>{county.id}</td>
                    <td>{county.name}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <CountiesModal reRenderCounties={this.reRenderCounties} toEdit={county}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(county.id)
                                }}>Törlés
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            )
        })
    }

    reRenderCounties() {
        this.getCounties()
    }


    componentDidMount() {
        this.getCounties()
    }

    handleDelete(id) {
        axios.delete(`/api/counties/${id}`).then(() => {
            this.reRenderCounties()
        })
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Megye név</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderCounties()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <CountiesModal reRenderCounties={this.reRenderCounties}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getCounties(pageNumber)
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

if (document.getElementById('general.counties')) {
    ReactDOM.render(<Counties/>, document.getElementById('general.counties'))
}
