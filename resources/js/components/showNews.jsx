import React, {useEffect, useRef, useState} from 'react';
import ReactDOM from 'react-dom/client';

function ShowNews() {
    const [news, setNews] = useState([]);
    const [categories, setCategories] = useState([]);

    useEffect(() => {
        getPosts();
        getCategories();
    }, []);

    const getPosts = (categoryId = '') => {
        let url = mainUrl + '/api/news';

        if (!_.isEmpty(categoryId)) {
            url = url + '?category=' + categoryId
        }

        fetch(url, {
                headers: {"Content-Type": "application/json; charset=utf-8"}
            },
        )
            .then(res => res.json())
            .then((res) => {
                setNews(res);
            })
            .catch(err => {
                console.log("Something went wrong.")
            });
    }

    const getCategories = () => {
        fetch(mainUrl + '/api/news/categories', {headers: {"Content-Type": "application/json; charset=utf-8"}})
            .then(res => res.json())
            .then((res) => {
                if (!_.isEmpty(res)) {
                    setCategories(res);
                }
            })
            .catch(err => {
                console.log("Something went wrong.")
            });
    }

    const OnCatBtnClicked = (e) => {
        const categoryId = e.target.attributes['data-id'].value;
        getPosts(categoryId)
    }

    let selectedNews = [];

    let i = 0;
    news.map((post) => {
        i++;
        if ( i > 3) {
            return;
        }

        if (post?.is_selected === 1) {
            selectedNews.push(<div key={post.id}><a target="_blank" href={mainUrl + post.slug}>{ post.title }</a></div>);
            }
        }
    )

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="grutto-blog-landing-header mb-4">
                    <span
                        className="btn btn-outline-primary m-2 grutto-landing-category-button"
                        data-id=""
                        onClick={(e) => OnCatBtnClicked(e)}
                    >
                            All posts
                        </span>
                        {categories.map((category) => (
                            <span
                                className="btn btn-outline-primary m-2 grutto-landing-category-button"
                                key={category.id}
                                data-id={category.id}
                                onClick={(e) => OnCatBtnClicked(e)}
                            >
                                {category.title}
                            </span>
                        ))}
                    {_.isEmpty(categories) ? 'Please add some categories, there is no category.' : ''}
                </div>
                <div className="grutto-blog-selected-news-box">
                    <div className="col-md-12">
                        <div className="card mb-2">
                            <div className="card-header d-flex justify-content-between">
                                <span><strong>Selected news</strong></span>
                            </div>
                            <div className="d-flex justify-content-between">
                                <div className="card-body">
                                    { _.isEmpty(selectedNews) ? 'There is no selected news' : selectedNews }
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {news.map((post) => (
                    <div className="col-md-12" key={post.id}>
                        <div className="card mb-2">
                            <div className="card-header d-flex justify-content-between">
                                <span>Title: <a target="_blank" href={mainUrl + post.slug}>{post.title}</a></span>
                                <span>{post.category.title}</span>
                            </div>

                            <div className="card-body">{post.content}</div>
                        </div>
                    </div>
                ))}
                {_.isEmpty(news) ? 'There is no posts.' : ''}
            </div>
        </div>
    );
}

export default ShowNews;

if (document.getElementById('main-card-body')) {
    const Index = ReactDOM.createRoot(document.getElementById("main-card-body"));

    Index.render(
        <ShowNews/>
    )
}
