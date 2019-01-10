import React from 'react';
import { Button, Row, Container } from 'reactstrap';

export default class Pagination extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            page: this.props.page,
            total: this.props.total,
            pages: Math.ceil(this.props.total / 9)
        }
    };

    componentDidUpdate(prevProps) {
        if(this.props !== prevProps){
            this.setState({
                page: this.props.page,
                total: this.props.total,
                pages: Math.ceil(this.props.total / 9)
            });
        }
    }

    getPages = () => {
        let pages = [];
        for(let i=1; i <= this.state.pages;  i++){
            pages.push(i)
        }
        let markup = pages.map( page => {
            if ((page -1) == this.state.page){
                return (<Button active color={"success"} onClick={()=>this.props.paginationClick(page-1)} key={page}> {page} </Button>)
            } else {
                return (<Button color={"success"} onClick={()=>this.props.paginationClick(page-1)} key={page}> {page} </Button>)
            }
        })

        return markup;
    };

    render() {
        // console.log(this.state.pages);
        //const pages = this.getPages();

        return (
            <Container className={"text-right"}>
                <br/><br/>
                {this.getPages()}
                <br/><br/>
            </Container>
        );
    }
}
