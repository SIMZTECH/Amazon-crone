export interface User {
    id: number;
    first_name:string,
    last_name:string,
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Address{
    id:number,
    user_id:string,
    addr1:string,
    addr2:string,
    city:string,
    postcode:string,
    country:string
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
        address:Address
    };
};
