import React, { Component } from 'react';
import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import Gallery from './Components/Gallery.js';
import FormComponent from './Components/FormComponent.js';
import Pagination from './Components/Pagination.js';
import { Row, Col, Modal, Button, ModalBody, ModalFooter, ModalHeader } from 'reactstrap';
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faDownload } from '@fortawesome/free-solid-svg-icons'
import { faEye } from '@fortawesome/free-solid-svg-icons'
import config from './config.json'

library.add(faEye);
library.add(faDownload);

class App extends Component {

    constructor(props){
        super(props);
        this.state = {
            images: [],
            modal: false,
            page: 0,
            total: 0,
            imageId: false,
            modalImage: ''
        };
    }

    componentWillMount(){
        this.getImages(0)
    }

    handleClick = (e) => {
        let imgId = e.target.dataset.id
        this.viewImage(imgId)
    }

    toggleModal = () => {
        this.setState({
            modal: !this.state.modal
        })
    }

    getImages = (page=0) => {
        fetch(config.apiHost+'/api/images/'+page).then(response => {
            return response.json()
        }).then(data => {
            this.setState({
                images: data.data,
                total: data.total
            })
        }).catch(err => {
            console.log('Fetch Images Error', err)
        })
    }

    downloadImage = () => {
        fetch(config.apiHost+'/api/image/download/'+this.state.modalImage.id).then(response => {
            return response.json()
        }).then(data => {
            window.location = data.data
            this.toggleModal()
        }).catch(err => {
            console.log('Fetch Download Image Error', err)
        })
    }

    viewImage = (id) => {
        fetch(config.apiHost+'/api/image/view/'+id).then(response => {
            return response.json()
        }).then(data => {
            this.setState({
                modalImage:data.data,
            })
            this.toggleModal()
        }).catch(err => {
            console.log('Fetch View Image Error', err)
        })
    }

    refresh = () => {
        this.getImages(this.state.page)
    }

    paginationClick = (page) => {
        this.state.page = page
        this.refresh()
    }

    render() {

        return (
            [
                <FormComponent refresh={this.refresh} />,
                <Gallery images={this.state.images} handleClick={this.handleClick} />,
                <Pagination page={this.state.page} paginationClick={this.paginationClick} total={this.state.total}/>,
                <Modal isOpen={this.state.modal} toggle={this.toggleModal} className={"lg"}>
                    <ModalHeader toggle={this.toggle}>{this.state.modalImage.name}</ModalHeader>
                    <ModalBody>
                        <img className={'img-fluid'} src={this.state.modalImage.imagePath} />
                    </ModalBody>
                    <ModalFooter>
                        <Button color="primary" onClick={this.downloadImage}>Download Image</Button>
                        <Button color="secondary" onClick={this.toggleModal}>Cancel</Button>
                    </ModalFooter>
                </Modal>
            ]
        )
    }
}

export default App
