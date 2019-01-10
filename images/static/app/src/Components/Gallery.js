import React, { Component } from 'react';
import { Container, Row, Col, Modal, Button, ModalBody, ModalFooter, ModalHeader } from 'reactstrap';
import Image from './Image.js';

export default class Gallery extends Component {

    constructor(props) {
        super(props);
    }

    handleClick = (args) => {
        this.props.handleClick(args);
    };

    render(){
        return(
            <Container>
                <Row>
                {this.props.images.map((img, index) => {
                    return(
                        <Image key={index} {...img} handleClick={this.props.handleClick} />
                    )
                })}
                </Row>
            </Container>
        );
    }
}
