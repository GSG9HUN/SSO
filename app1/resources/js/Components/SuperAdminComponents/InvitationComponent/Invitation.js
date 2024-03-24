import React from "react";
import ReactDOM from "react-dom";
import InvitationModal from "./InvitationModal";
import Pagination from "react-js-pagination";


export default class Invitation extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            invitations: [],
            currentPage:1,
            total:0,
            perPage:0,
        }

        this.renderInvitations = this.renderInvitations.bind(this)
        this.reRenderInvitations = this.reRenderInvitations.bind(this)
        this.getInvitations = this.getInvitations.bind(this)
    }


    getInvitations(pageNumber = 1) {
        axios.get(`/api/invitations?page=${pageNumber}`
        ).then((response) => {
            this.setState({
                invitations:[...response.data.invitations.data],
                currentPage: response.data.invitations.current_page,
                perPage: response.data.invitations.perPage,
                total: response.data.invitations.total
            })
        })
    }

    reRenderInvitations() {
        this.getInvitations()
    }


    renderInvitations() {
        return this.state.invitations.map((invitation, index) => {
            return(
                <tr key={index}>
                    <td>{invitation.id}</td>
                    <td>{invitation.email}</td>
                    <td>{invitation.invitation_token}</td>
                    <td>{invitation.registered_at}</td>
                </tr>
            )
        })
    }

    componentDidMount() {
        this.getInvitations();
    }

    render() {
        return (
            <div className={'table-container'}>
                <table className={'data-table'}>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Meghívó kód</th>
                            <th>Regisztrációs dátum</th>
                        </tr>
                    </thead>
                    <tbody>
                    {this.renderInvitations()}
                    </tbody>
                </table>
                <div className={'row-buttons'}>
                    <InvitationModal reRenderInvitations ={this.reRenderInvitations}/>
                </div>
                <div className={'pagination-container'}>
                    <Pagination
                        onChange={(pageNumber)=>{
                            this.getInvitations(pageNumber)
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

if (document.getElementById('invitations')) {
    ReactDOM.render(<Invitation/>, document.getElementById('invitations'))
}
