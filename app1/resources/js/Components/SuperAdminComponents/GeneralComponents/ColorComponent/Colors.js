import React from "react";
import ReactDOM from "react-dom";
import ColorsModal from "./ColorsModal";
import Pagination from "react-js-pagination";


export default class Colors extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            colors: [],
            perPage: 0,
            total: 0,
            currentPage: 1
        }

        this.getColors = this.getColors.bind(this)
        this.renderColors = this.renderColors.bind(this)
        this.reRenderColors = this.reRenderColors.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }

    getColors(pageNumber = 1) {
        axios.get(`/api/colors?page=${pageNumber}`).then((response) => {
            this.setState({
                colors: response.data.colors.data,
                parPage: response.data.colors.per_page,
                total: response.data.colors.total,
                currentPage: response.data.colors.current_page
            })
        })
    }

    renderColors() {
        return this.state.colors.map((color, index) => {
            return (
                <tr key={index}>
                    <td>{color.id}</td>
                    <td>{color.name}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <ColorsModal reRenderColors={this.reRenderColors} toEdit={color}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(color.id)
                                }}>Törlés
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            )
        })
    }

    reRenderColors() {
        this.getColors()
    }

    componentDidMount() {
        this.getColors()
    }

    handleDelete(id) {
        axios.delete(`/api/colors/${id}`).then(() => {
            this.reRenderColors()
        })
    }


    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Szín</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderColors()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <ColorsModal reRenderColors={this.reRenderColors}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getColors(pageNumber)
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

if (document.getElementById('general.colors')) {
    ReactDOM.render(<Colors/>, document.getElementById('general.colors'))
}
