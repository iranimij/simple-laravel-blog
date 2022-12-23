const validationFunctions = () => {
    document.getElementById('post_slug').addEventListener( 'keyup', ( e ) => {
        const value = e.target.value;
        const url = maybeAddSlashAtFirst( value );

        var commaSeparatedSixDigits = /(?<!\/nl)\/article\/[^\d]/;
        if ( ! commaSeparatedSixDigits.test(url)) {

            document.querySelector( '.grutto-blog-slug-input span').innerHTML  = 'The slug pattern is not correct.';
            return;
        };

        document.querySelector( '.grutto-blog-slug-input span').innerHTML  = '';
    });

    const maybeAddSlashAtFirst = ( url ) => {
        let firstLetter = url.substring(0, 1);

        if ( firstLetter === '/' ) {
            return url;
        }

        return '/' + url;
    }
}

export default validationFunctions();