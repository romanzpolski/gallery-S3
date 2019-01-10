import React, { Component } from 'react';
import { Container, Row, Col, Media } from 'reactstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'


export default class Image extends Component {

    constructor(props) {
        super(props);
        this.state = {
            views: this.props.views,
            downloads: this.props.downloads
        }
    };

    componentDidMount() {
        this.interval = setInterval(() => {
            //this.getData(this.props.id);
        }, 10000);
    }

    componentWillUnmount() {
        clearInterval(this.interval);
    }

    componentDidUpdate(prevProps) {
        if(this.props.id !== prevProps.id){
            this.setState({
                views: this.props.views,
                downloads: this.props.downloads
            });
            this.getData(this.props.id)
        }
    }

    getData = (id) => {
        fetch('http://localhost/api/image/getData/'+id).then(response => {
            return response.json();
        }).then(data => {
            this.setState({
                views: data.data.views,
                downloads: data.data.downloads
            });
        }).catch(err => {
            console.log('Fetch get image data failed', err);
        });
    };

    render(){
        return(
            <Col sm="4">
                <br />
                <h6 className={'text-center'}>{this.props.name}</h6>
                <img data-id={this.props.id} onClick={this.props.handleClick} className={'img-fluid'} src={this.props.path} alt={this.props.name} />
                <Row>
                    <Col xs="3"><FontAwesomeIcon icon="eye" /></Col>
                    <Col xs="9" className={'text-right'}>{this.state.views}</Col>
                </Row>
                <Row>
                    <Col xs="3"><FontAwesomeIcon icon="download" /></Col>
                    <Col xs="9" className={'text-right'}><span>{this.state.downloads}</span></Col>
                </Row>
            </Col>
        );
    }
}
