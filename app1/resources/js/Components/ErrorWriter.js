export const ErrorWriter = ({errors}) => {

    const keys = Object.keys(errors)

    return keys.map((key) => {
        return errors[key].map((data, index) => {
            return (
                <div key={index} className={'validation-error'}>
                    <p >
                        {data}
                    </p>
                </div>
            )
        })
    })
}
