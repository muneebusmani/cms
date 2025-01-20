import React, { JSX } from 'react';

interface Pdf {
    hash: string | null | undefined;
    path: string | null | undefined;
}

interface Article {
    title: string;
    description: string;
    thumbnail: string;
    pdfs: Pdf[];
}

const SampleArticle: Article = {
    description = '',
    pdfs = [[(hash = ''), (path = '')]],
    thumbnail = '',
    title = '',
};
const Index: React.FC<Article> = (): JSX.Element => {
    const [title, description, thumbnail, pdfs] = ['', '', '', ['']];
    return (
        <>
            <head>
                <title>{title}</title>
                <meta name="description" content={description} />
            </head>
            <img src={thumbnail} alt={title} />
            <main>
                {pdfs.map(
                    (pdf: string): JSX.Element => (
                        <>{pdf}</>
                    ),
                )}
            </main>
        </>
    );
};
export default Index;
