"use client";
import { useEffect, useState } from "react";
import RatingStarsSubmit from '../../../components/RatingStarsSubmit';
import styles from '../../../page.module.css';

import {
  Container,
  Button,
  Heading,
  Center,
  Input,
  Textarea,
  useToast,
  Image,
  Box,
  Card,
  Stack,
  Text,
  CardBody,
  CardFooter,
} from '@chakra-ui/react';
import axios from "axios";

export default function EditMovie({ params }: { params: { id: string } }) {

    const toast = useToast();

    interface Movie {
        movie_id: number,
        title: string,
        genre: string,
        duration: number,
        views: number,
        rating: number,
        poster: string,
        description: string
    }
    const [movie, setMovie] = useState<Array<Movie>>([]);

    useEffect(() => {
        GetMovie();
    }, []);

    function GetMovie() {
        let url = 'http://127.0.0.1:8000/api/movies/'+ params.id + '/';

        axios.get(url)
        .then(res => {
            console.log(res.data)
            setMovie(res.data)
            setFormData({"movie_id": res.data.id, "title": res.data.title, genre: res.data.genre, duration: Number(res.data.duration), views: Number(res.data.views), rating: Number(res.data.rating), poster: res.data.poster, description: res.data.description});
            
        })
        .catch(err => console.log(err))
    };

    const [formData, setFormData] = useState({
        movie_id: -1,
        title: '',
        genre: '',
        duration: 0,
        views: 0,
        rating: 0,
        poster: '',
        description: ''
    });

    const { movie_id, title, genre, duration, views, rating, poster, description } = formData;

    const onChange = (e: React.ChangeEvent<HTMLInputElement>) => setFormData({ ...formData, [e.target.name]: e.target.value });
    const onSelectChange = (e: React.ChangeEvent<HTMLSelectElement>) => setFormData({ ...formData, [e.target.name]: e.target.value });
    const onTextAreaChange = (e: React.ChangeEvent<HTMLTextAreaElement>) => setFormData({ ...formData, [e.target.name]: e.target.value });

    const onSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        
        let body = JSON.stringify(formData)
        console.log(body)
        let url = 'http://127.0.0.1:8000/api/movies/' + String(movie_id) +'/';

        axios.put(url, body, {
            headers: {
            'content-type': 'application/json'
            }
        })
        .then(res => {
            return (
                toast({
                    title: 'Success!',
                    description: "Your review has been added successfully.",
                    status: 'success',
                    duration: 9000,
                    isClosable: true,
                })
            )
        })
        .catch(err => {
            return (
                toast({
                    title: 'Oops!',
                    description: "An error has occured.",
                    status: 'error',
                    duration: 9000,
                    isClosable: true,
                })
            )
        })
    };

    return (
        <Container maxW={'7xl'}>
            <Container>
                <Heading
                    my={5}
                    textAlign='center'
                    lineHeight={1.1}
                    fontWeight={600}
                    fontSize={{ base: '2xl', sm: '4xl', lg: '5xl' }}>
                    Edit Movie
                </Heading>

                <form onSubmit={e => onSubmit(e)}>
                    <Heading size='md' mt={5} mb={2}>Title</Heading>
                    <Input placeholder="Movie Title" name="title" value={title} onChange={e => onChange(e)} required/>
                    <Heading size='md' mt={5} mb={2}>Title</Heading>
                    <Input placeholder="Genre" name="genre" value={genre} onChange={e => onChange(e)} required/>
                    <Heading size='md' mt={5} mb={2}>Duration</Heading>
                    <Input placeholder="Movie's Duration" name="duration" value={duration} onChange={e => onChange(e)} required/>
                    <Heading size='md' mt={5} mb={2}>Views</Heading>
                    <Input placeholder="Movie's Views" name="views" value={views} onChange={e => onChange(e)} required/>
                    <Heading size='md' mt={5} mb={2}>Rating</Heading>
                    <Box>
                    <input type="range" min="1" max="10" name="rating" value={rating} onChange={e => onChange(e)} id="ratingRange" className={styles.ratingrange} required/>
                    <RatingStarsSubmit rating={rating}/>
                    </Box>
                    <Heading size='md' mt={5} mb={2}>Poster</Heading>
                    <Input placeholder="Movie's Poster Link" name="poster" value={poster} onChange={e => onChange(e)} required/>
                    <Heading size='md' mt={5} mb={2}>Description</Heading>
                    <Textarea placeholder='Describe the movie.' name="description" value={description} onChange={e => onTextAreaChange(e)} required/>
                    <Center><Button type='submit' colorScheme='blue' my={5} w='50em'>Save</Button></Center>
                </form>
            </Container>
        </Container>
    )
}