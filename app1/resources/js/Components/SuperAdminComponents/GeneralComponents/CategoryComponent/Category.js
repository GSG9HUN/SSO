import React from "react";
import ReactDOM from "react-dom";
import CategoryModal from "./CategoryModal";
import Pagination from "react-js-pagination";


export default class Category extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            categories: [],
            perPage: 0,
            total: 0,
            currentPage: 1
        }
        this.getCategories = this.getCategories.bind(this)
        this.renderCategories = this.renderCategories.bind(this)
        this.reRenderCategories = this.reRenderCategories.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }

    getCategories(pageNumber = 1) {
        axios.get(`/api/category?page=${pageNumber}`).then((response) => {
            this.setState({
                categories: response.data.categories.data,
                perPage: response.data.categories.per_page,
                total: response.data.categories.total,
                currentPage: response.data.categories.current_page,
            })
        })
    }

    renderCategories() {

        return this.state.categories.map((category, index) => {
            return (
                <tr key={index}>
                    <td>{category.id}</td>
                    <td>{category.name}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <CategoryModal reRenderCategories={this.reRenderCategories} toEdit={category}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(category.id)
                                }}>Törlés
                                </button>
                            </div>
                        </div>

                    </td>
                </tr>
            )
        })
    }

    handleDelete(id) {
        axios.delete(`/api/category/${id}`).then(() => {
            this.getCategories()
        })
    }

    reRenderCategories() {
        this.getCategories()
    }

    componentDidMount() {
        this.getCategories()
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Állat megnevezés</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderCategories()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <CategoryModal reRenderCategories={this.reRenderCategories}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getCategories(pageNumber)
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

if (document.getElementById('general.categories')) {
    ReactDOM.render(<Category/>, document.getElementById('general.categories'))
}
