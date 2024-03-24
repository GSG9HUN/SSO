import React from "react";
import ReactDOM from "react-dom";
import SizeModal from "./SizeModal";
import Pagination from "react-js-pagination";


export default class Size extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            sizes: [],
            currentPage: 1,
            total: 0,
            perPage: 0,
        }

        this.getSizes = this.getSizes.bind(this)
        this.renderSizes = this.renderSizes.bind(this)
        this.reRenderSizes = this.reRenderSizes.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }


    getSizes(pageNumber = 1) {
        axios.get(`/api/size?page=${pageNumber}`).then((response) => {
            this.setState({
                sizes: response.data.sizes.data,
                total: response.data.sizes.total,
                perPage: response.data.sizes.per_page,
                currentPage: response.data.sizes.current_page

            })
        })
    }

    renderSizes() {
        return this.state.sizes.map((size, index) => {
            return (
                <tr key={index}>
                    <td>{size.id}</td>
                    <td>{size.name}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <SizeModal reRenderCounties={this.reRenderSizes} toEdit={size}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(size.id)
                                }}>Törlés
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            )
        })
    }

    reRenderSizes() {
        this.getSizes()
    }

    componentDidMount() {
        this.getSizes()
    }

    handleDelete(id) {
        axios.delete(`/api/size/${id}`).then(() => {
            this.reRenderSizes()
        })
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'} >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Méret</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderSizes()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <SizeModal reRenderSize={this.reRenderSize}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getSizes(pageNumber)
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

if (document.getElementById('general.size')) {
    ReactDOM.render(<Size/>, document.getElementById('general.size'))
}
