import React from "react";
import ReactDOM from "react-dom";
import SettlementModal from "./SettlementModal";
import Pagination from "react-js-pagination";

export default class Settlement extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            settlement: [],
            currentPage: 1,
            perPage: 0,
            total: 0,
        }

        this.getSettlement = this.getSettlement.bind(this)
        this.renderSettlement = this.renderSettlement.bind(this)
        this.reRenderSettlement = this.reRenderSettlement.bind(this)
        this.handleDelete = this.handleDelete.bind(this)
    }

    getSettlement(pageNumber = 1) {
        axios.get(`/api/settlement?page=${pageNumber}`).then((response) => {
            console.log(response.data)
            this.setState({
                settlement: response.data.settlement.data,
                perPage: response.data.settlement.per_page,
                total: response.data.settlement.total,
                currentPage: response.data.settlement.current_page,
            })
        })
    }

    renderSettlement() {
        return this.state.settlement.map((settlement, index) => {
            return (
                <tr key={index}>
                    <td>{settlement.id}</td>
                    <td>{settlement.name}</td>
                    <td>{settlement.county.name}</td>
                    <td>
                        <div className={'button-img'}>
                            <div className={'edit'}>
                                <SettlementModal reRenderSettlement={this.reRenderSettlement} toEdit={settlement}/>
                            </div>
                            <div className={'delete'}>
                                <button onClick={() => {
                                    this.handleDelete(settlement.id)
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
        axios.delete(`/api/settlement/${id}`).then(() => {
            this.getSettlement()
        })
    }

    reRenderSettlement() {
        this.getSettlement()
    }

    componentDidMount() {
        this.getSettlement()
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Település neve</th>
                        <th>Megye neve</th>
                        <th>Műveletek</th>
                    </tr>
                    </thead>
                    <tbody>
                    {this.renderSettlement()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <SettlementModal reRenderSettlement={this.reRenderSettlement}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber) => {
                            this.getSettlement(pageNumber)
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

if (document.getElementById('general.settlement')) {
    ReactDOM.render(<Settlement/>, document.getElementById('general.settlement'))
}
