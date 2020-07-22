import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListMetierComponent } from './list-metier.component';

describe('ListMetierComponent', () => {
  let component: ListMetierComponent;
  let fixture: ComponentFixture<ListMetierComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListMetierComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListMetierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
