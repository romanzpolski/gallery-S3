import React, { Component } from 'react';
import { Container, Row, Col, Media, Button, Form, FormGroup, Label, Input, FormText } from 'reactstrap';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCircleNotch } from '@fortawesome/free-solid-svg-icons'

export default class FormComponent extends Component {

    constructor(props) {
        super(props);
        this.state = {
            name: '',
            file: {},
            loading: false
        }
    };

    submitForm = (e) => {
        e.preventDefault()
        this.fileUpload()
    };

    handleNameChange = (e) => {
        this.state.name = e.target.value;
    };

    handleFileChange = (e) => {
        this.state.file = e.target.files[0];
    };

    fileUpload = () => {
        this.setState({
            loading: true
        });
        const url = 'http://localhost/api/image/upload';
        const formData = new FormData();
        formData.append('image', this.state.file );
        formData.append('name', this.state.name );
        const config = {
            method: 'POST',
            body: formData
        };
        fetch(url, config).then(response => {
            if(response.ok) {
                this.props.refresh();
            }
            return response.json();
        }).then(data => {
            this.setState({
                loading: false
            })
        }).catch(err => {
            console.log('Fetch Error', err);
        });

    };

    render(){
        return(
            <Container>
                {this.state.loading ? (
                    <FontAwesomeIcon icon={faCircleNotch} spin />
                ) : (
                    <Form className={'upload-form'} onSubmit={ this.submitForm }>
                        <FormGroup>
                        <Label for={"name"}>Name</Label>
                        <Input onChange={this.handleNameChange} type={"text"} name={"name"} id={"name"} placeholder={"Name"} />
                        </FormGroup>
                        <FormGroup>
                        <Label for={"image"}>File</Label>
                        <Input onChange={this.handleFileChange} type={"file"} name={"image"} id={"image"} />
                        </FormGroup>
                        <Button className={'success'} >Upload</Button>
                        <br/><br/>
                    </Form>
                )}
            </Container>
    );
    }
}
