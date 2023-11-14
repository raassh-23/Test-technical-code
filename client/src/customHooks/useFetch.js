import { useEffect, useState } from "react";

export default function useFetch(url) {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        if (!url) return;

        setLoading(true);
        setError(null);

        const abortController = new AbortController();

        fetch(url, {
            signal: abortController.signal,
        })
            .then((res) => res.json())
            .then((body) => {
                if (body.error) {
                    throw new Error(body.message);
                }

                setData(body.data)
                setLoading(false)
            })
            .catch((err) => {
                if (err?.name === "AbortError") {
                    return;
                }

                setError(err);
                setLoading(false)
            })

        return () => abortController.abort();
    }, [url]);

    return {
        data,
        error,
        loading,
    };
}
