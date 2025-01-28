export class Nurse {
    id: string = '';
    name: string = '';
    pwd: string= '';
    gmail: string = '';
    constructor(gmail: string  = "", pwd: string = "") {
        this.gmail = gmail;
        this.pwd = pwd;
    }
}