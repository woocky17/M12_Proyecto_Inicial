import { Component, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import jsonData from '../data/data.json';

@Component({
  selector: 'app-find-nurse',
  templateUrl: './find-nurse.component.html',
  styleUrl: './find-nurse.component.css'
})

export class FindNurseComponent implements AfterViewInit {

  nurses: Nurse[] = jsonData;
  @ViewChild("nameInput", { static: true }) NurseName!: ElementRef;
  @ViewChild("nurseName", { static: false }) showNurseName!: ElementRef;
  @ViewChild("nurseId", { static: false }) showNurseId!: ElementRef;
  @ViewChild("nurseGmail", { static: false }) showNurseGmail!: ElementRef;

  ngAfterViewInit() {
    this.NurseName.nativeElement.value = '';
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