import { Injectable, ViewChild, ElementRef } from '@angular/core';
import jsonData from '../data/data.json';
import { FormControl, FormGroup } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';

@Injectable()
export class nurseService {
    @ViewChild("nameInput", { static: true }) NurseName!: ElementRef;
    @ViewChild("nurseName", { static: false }) showNurseName!: ElementRef;
    @ViewChild("nurseId", { static: false }) showNurseId!: ElementRef;
    @ViewChild("nurseGmail", { static: false }) showNurseGmail!: ElementRef;
    ngAfterViewInit() {
        this.NurseName.nativeElement.value = '';
    }
    nurses: Nurse[] = jsonData;
    constructor(private _router: Router,
        private _activRoute: ActivatedRoute) { }

    form = new FormGroup({
        gmail: new FormControl(''),
        pwd: new FormControl('')
    });
    login() {
        let value = this.form.value;

        console.log('Form values:', value); // Muestra los valores ingresados
        console.log('Nurses array:', this.nurses); // Muestra los datos cargados

        const nurse = this.nurses.find(
            (n) =>
                n.gmail.toLowerCase() === value.gmail?.trim().toLowerCase() &&
                n.pwd === value.pwd?.trim()
        );

        if (nurse) {
            alert(`Welcome, ${nurse.name}!`);
            this._router.navigate(['/findOne']);
            this._router.navigate(['/getAll']);
        } else {
            alert('Invalid Gmail or Password');
        }
    }
    findNurse() {

        const inputName = this.NurseName.nativeElement.value.toLowerCase();
        let found = false;
        for (let nurse of this.nurses) {
            if (inputName === nurse.name.toLowerCase()) {
                this.showNurseId.nativeElement.innerHTML = nurse.id.toString();
                this.showNurseName.nativeElement.innerHTML = nurse.name;
                this.showNurseGmail.nativeElement.innerHTML = nurse.gmail;
                found = true;
                break;
            }
        }
        if (!found) {
            this.showNurseId.nativeElement.innerText = "Not found!";
            this.showNurseName.nativeElement.innerHTML = '';
            this.showNurseGmail.nativeElement.innerHTML = '';
        }
    }
}
class Nurse {
    id: string = '';
    name: string = '';
    pwd: string = '';
    gmail: string = '';
}