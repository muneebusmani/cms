export const Index = (): React.JSX.Element => {
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
                    (pdf: string): React.JSX.Element => (
                        <>{pdf}</>
                    ),
                )}
            </main>
        </>
    );
};
